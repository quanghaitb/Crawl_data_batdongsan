import mysql.connector


config = {
  'user': 'root',
  'password': 'password',
  'host': 'localhost',
  'database': 'du_an_ban_dat',
  'raise_on_warnings': True
}

cnx = mysql.connector.connect(**config)

conn = cnx.cursor()

def get_description_table(table, *field):
  if not field:
    field = '*'
  query = "SELECT " + str(field) + " FROM "+ str(table) 
  conn.execute(query)
  rows = conn.fetchall()
  
  field_names = [i[0] for i in conn.description]
  return field_names


def get_news_by_day(date_from, date_to):
  query = "SELECT * FROM infor_news where created_at between " + str(date_from) + " and " +str(date_to)
  conn.execute(query)
  rows = conn.fetchall()
  return rows
  

def get_all_provinces():
  query = "SELECT * FROM provinces"
  conn.execute(query)
  rows = conn.fetchall()
  return rows


def get_only_row(table, **args):
  where_condition = ''
  for key, where in args.items():
    where_condition = str(key) +" = '"+ str(where) + "'"
  query = "SELECT * FROM " +table+ " where "+ str(where_condition) 
  conn.execute(query)
  rows = conn.fetchall()
  return rows


def select_all_rows_data (table, *field, **limit):
  if not field:
    field = '*'
  for key, where in limit.items():
    if key == 'limit':
      limit_condition = " " + str(key) + " " + str(where) 
    else:
      limit_condition = " where " + str(key) + "=" + str(where) 
  if limit:
    query = "SELECT " + str(field) + " FROM "+ str(table)  + limit_condition
    conn.execute(query)
    rows = conn.fetchall()
    return rows
  else:
    query = "SELECT " + str(field) + " FROM "+ str(table) 
    conn.execute(query)
    rows = conn.fetchall()
    return rows



def select_row_data (table, *fields, **wheres):
  where_condition = ''
  field = ''
  for key, where in wheres.items():
    where_condition = str(key) +" = "+ str(where)
  for x in fields:
        field += x
  query = "SELECT " + str(field) + " FROM "+ str(table) +" WHERE " + where_condition
  conn.execute(query)
  rows = conn.fetchall()
  return rows[0][0]

def query_insert(table, **args):
  fields = ",".join(args.keys())
  for key, value_update in args.items():
    value_update = str(value_update).replace("'",'`')
    args[key]= value_update
  values =  "'" + "','".join(map(str, args.values())) + "'"

  query = "INSERT INTO " + str(table)+ " ("+ str(fields) + ") VALUES ( "+ values +")"
  conn.execute(query)
  cnx.commit()
def query_update(table, args ,  **where ):
  
  values = ''
  check = 0
  where_condition = ''
  for key, value in args.items():
    if len(args) == 1:
      values += str(key) + " = " + str(value)
    else:
      if check == len(args):
        values += str(key) + " = " + str(value)
      else:
        values += str(key) + " = " + str(value)
        values += ","
      check += 1
  
  for key, where in where.items():
    where_condition += str(key) +" = '"+ str(where) +"'"
  
    
  # fields = ",".join(args.keys())

  # values =  "'" + "','".join(map(str, args.values())) + "'"

  query = "UPDATE " + str(table)+ " SET " + str(values)+ " WHERE "+ str(where_condition) 
  conn.execute(query)
  cnx.commit()
  
  
