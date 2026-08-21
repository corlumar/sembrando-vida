#!/usr/bin/env python3
"""
MEF-V3 governance integrity validator — FASE 12.4

Usage examples:
  python validate_mef_v3_governance.py --catalog path/to/catalog.csv
  python validate_mef_v3_governance.py --catalog catalog.csv --aliases aliases.csv --changes changes.csv

Exit codes:
  0 = PASS
  1 = BLOCKED (integrity errors)
  2 = configuration/input error
"""
from __future__ import annotations
import argparse, re, sys
from pathlib import Path
import pandas as pd

def norm(v):
    return " ".join(str(v).strip().casefold().split())

def pick(df, candidates):
    lut={norm(c).replace(" ","_"):c for c in df.columns}
    for c in candidates:
        k=norm(c).replace(" ","_")
        if k in lut: return lut[k]
    return None

def read_csv(path):
    p=Path(path)
    if not p.exists():
        raise FileNotFoundError(str(p))
    return pd.read_csv(p, dtype=str).fillna("")

def add(findings, vid, severity, scope, value, detail):
    findings.append(dict(validation_id=vid,severidad=severity,scope=scope,valor=value,detalle=detail))

def validate_catalog(df, findings):
    idc=pick(df,["mef_v3_id","mef_dic_id_v3","id"])
    namec=pick(df,["termino_canonico","nombre_canonico_pre_id","nombre_canonico","term"])
    authc=pick(df,["autoridad_10_4","autoridad","authority"])
    statusc=pick(df,["estado","status"])
    if not idc or not namec:
        add(findings,"CFG-001","ERROR","catalog","","No se localizaron columnas de ID y nombre canónico.")
        return
    ids=df[idc].map(str).str.strip()
    for v,n in ids.value_counts().items():
        if v and n>1: add(findings,"VAL-001","ERROR","catalog",v,f"ID duplicado ({n} filas).")
    for i,row in df.iterrows():
        ident=str(row[idc]).strip(); name=str(row[namec]).strip()
        if not ident: add(findings,"VAL-002","ERROR",f"row:{i+2}","", "ID vacío.")
        if not name: add(findings,"VAL-004","ERROR",ident,"Nombre canónico vacío.")
    nn=df[namec].map(norm)
    for v,n in nn[nn!=""].value_counts().items():
        if n>1: add(findings,"VAL-005","ERROR","catalog",v,f"Nombre canónico normalizado duplicado ({n}).")
    if authc:
        active=df if not statusc else df[~df[statusc].map(norm).isin(["deprecated","deprecado"])]
        for i,row in active.iterrows():
            if not str(row[authc]).strip():
                add(findings,"VAL-008","ERROR",str(row[idc]),"","Autoridad no definida.")

def validate_aliases(df, findings):
    aliasc=pick(df,["forma_observada","alias","termino_alias"])
    idc=pick(df,["mef_v3_id","mef_dic_id_v3","id"])
    if not aliasc or not idc:
        add(findings,"CFG-002","ERROR","aliases","","No se localizaron columnas alias e ID.")
        return
    work=df[[aliasc,idc]].copy()
    work["_n"]=work[aliasc].map(norm)
    for a,g in work[work["_n"]!=""].groupby("_n"):
        ids=set(x.strip() for x in g[idc] if str(x).strip())
        if len(ids)>1:
            add(findings,"VAL-006","ERROR","aliases",a,"Alias apunta a múltiples IDs: "+",".join(sorted(ids)))

def validate_changes(df, findings):
    cid=pick(df,["change_id"])
    state=pick(df,["estado","status"])
    decision=pick(df,["decision"])
    commit=pick(df,["commit_aplicacion","commit"])
    if not cid:
        add(findings,"CFG-003","ERROR","changes","","No existe columna CHANGE_ID.")
        return
    vals=df[cid].map(str).str.strip()
    for i,v in vals.items():
        if not v: add(findings,"VAL-014","ERROR",f"row:{i+2}","","CHANGE_ID vacío.")
    for v,n in vals[vals!=""].value_counts().items():
        if n>1: add(findings,"VAL-015","ERROR","changes",v,f"CHANGE_ID duplicado ({n}).")
    if state:
        for i,row in df.iterrows():
            st=norm(row[state]); dec=norm(row[decision]) if decision else ""
            if st in ["aplicado","validado","cerrado"] and dec not in ["aprobar","aprobado"]:
                add(findings,"VAL-016","ERROR",str(row[cid]),st,"Cambio aplicado/cerrado sin decisión aprobatoria.")
            if st=="cerrado" and commit and not str(row[commit]).strip():
                add(findings,"VAL-020","ERROR",str(row[cid]),"","Expediente cerrado sin commit de aplicación.")

def main():
    ap=argparse.ArgumentParser()
    ap.add_argument("--catalog", required=True)
    ap.add_argument("--aliases")
    ap.add_argument("--changes")
    ap.add_argument("--out", default="MEF_V3_VALIDATION_REPORT.csv")
    args=ap.parse_args()
    findings=[]
    try:
        validate_catalog(read_csv(args.catalog), findings)
        if args.aliases: validate_aliases(read_csv(args.aliases), findings)
        if args.changes: validate_changes(read_csv(args.changes), findings)
    except Exception as e:
        print("CONFIGURATION_ERROR:", e, file=sys.stderr)
        return 2
    out=pd.DataFrame(findings,columns=["validation_id","severidad","scope","valor","detalle"])
    out.to_csv(args.out,index=False,encoding="utf-8-sig")
    errors=int((out["severidad"]=="ERROR").sum()) if len(out) else 0
    print(f"RESULT={'BLOCKED' if errors else 'PASS'} ERRORS={errors} REPORT={args.out}")
    return 1 if errors else 0

if __name__=="__main__":
    raise SystemExit(main())
