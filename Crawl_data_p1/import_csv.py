

from datetime import datetime
from db_connection import *
import pandas as pd



def export_default_file_csv(table, name_websie, province, type ,limit_number = 10):

    date_now = f"{datetime.now():%H-%M %Y-%m-%d}"
    name_file = str(date_now).replace(" ",'_') + "_" + str(name_websie).replace(" ", "-").lower() + "_"+ str(province).replace(" ", "-").lower() + "_"+ str(type).lower() + ".xlsx"
    df = pd.read_sql_query('select title,detail_address,title_address,price,unit_price,bedroom,toilet,law,indoor,road,face_first,floor,direction_balcony,description,area,unit_area,images,type_new,direction_of_house,created_at,exp_at from ' + table +' limit ' + str(limit_number), cnx)
    df.to_excel(name_file, index=False, engine='openpyxl')
        

def export_special_file_file_csv(table, name_websie, province, type ,limit_number = 10, *fields):
    str_fields = ",".join(fields)
    date_now = f"{datetime.now():%H-%M %Y-%m-%d}"
    name_file = str(date_now).replace(" ",'_') + "_" + str(name_websie).replace(" ", "-").lower() + "_"+ str(province).replace(" ", "-").lower() + "_"+ str(type).lower() + ".xlsx"
    df = pd.read_sql_query('select '+ str_fields +' from ' + table +' limit ' + str(limit_number), cnx)
    df.to_excel(name_file, index=False, engine='openpyxl')
    
    
export_special_file_file_csv('infor_news', 'batdongsan', 'Ha Noi', 'BAN',50, 'title', 'unit_price', 'bedroom', 'description', 'images' )