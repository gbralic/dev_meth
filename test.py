## Import libraries

import sqlite3
import numpy as np
import pandas as pd

## Connection to the database and retrieving data
conn = sqlite3.connect('doctordb.sqlite')
c = conn.cursor()

c.execute("SELECT q_name FROM questions")
que = c.fetchall()

c.execute("SELECT * FROM answers")
ans = c.fetchall()
conn.close()

## Creation of the dataset
col = []
for i in que:
    col.append(i[0])

data = []
for i in ans:
    data.append(i[1:])

df = pd.DataFrame(data,columns=col)

## Definition of functions

# Function who calculates the pourcentage of Yes and No in a dataset.
def pour(df):
    m_q = df.keys()[0]
    res = df[m_q]
    pos = 0
    neg = 0
    for i in res:
        if (i=="Yes"):
            pos+=1
        else:
            neg+=1
    tot = pos+neg
    return(pos/tot, neg/tot)

# Function who calculate the entropy of a dataset.
def entropy(df):
    p = pour(df)
    if (p[0]==0 or p[0]==1):
        ent = 0
    else:
        if p[0]==p[1]:
            ent = 1
        else:
            ent = -p[0]*np.log2(p[0])-(p[1])*np.log2(p[1])
    return ent

# Calculate the gain of a dataset
def gain(df):
    e = entropy(df)
    list_gain=[]
    q = df.keys()[1:]
    for i in q:
        entro = e
        var = df[i].unique()
        for j in var:
            reduced_df = df[df[i]==j]
            entro -= (len(reduced_df)/len(df))*entropy(reduced_df)
        list_gain.append(entro)
    return q[list_gain.index(max(list_gain))]

def end_tree(df):
    end = False
    if (entropy(df)==0):
        end = True
    return end

def buildTree(df,tree=None):
    m_q = df.keys()[0]
    f_q = gain(df)
    if tree is None:
        tree = {}
        tree[f_q]={}
    for i in df[f_q].unique():
        sub_df = df[df[f_q]==i]
        if end_tree(sub_df):
            tree[f_q][i]=list(sub_df[m_q])[0]
        else:
            tree[f_q][i] = buildTree(sub_df)
    return tree

### Main program

Tree = buildTree(df) ## Entropy of the total dataset
print(Tree)
