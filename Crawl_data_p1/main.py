import requests
import random
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from db_connection import *
from selenium.webdriver.common.by import By
import time
from collect_data_from_web import *
from decimal import Decimal


insert_all_link_new()

all_news = select_all_rows_data('news', status = 0)
for row in all_news:
    all_infor = None
    href = row[1]
    id_news = row[0]
    id_province = row[2]
    get_check_status_new = select_row_data('news', "status" , id =  id_news)
    if get_check_status_new == '0':
        all_infor = get_all_infor(href)
        if all_infor:
            result_insert = query_insert('infor_news', 
                        title = '' if not all_infor.get('title') else all_infor.get('title'), 
                        detail_address = '' if not all_infor.get('address') else all_infor.get('address'), 
                        title_address = '' if not all_infor.get('address') else  all_infor.get('address'),
                        price = 'Thỏa thuận' if not all_infor.get('price') else all_infor.get('price').replace(',','.'),
                        unit_price = '' if not all_infor.get('unit_price') else all_infor.get('unit_price'),
                        bedroom = '' if not all_infor.get('bedroom') else int(all_infor.get('bedroom')),
                        toilet = '' if not all_infor.get('toilet') else int(all_infor.get('toilet')),
                        law = '' if not all_infor.get('Pháp lý') else all_infor.get('Pháp lý'),
                        indoor = '' if not all_infor.get('Nội thất') else all_infor.get('Nội thất'),
                        floor = '' if not all_infor.get('floor') else int(all_infor.get('floor')),
                        road = '' if not all_infor.get('road') else all_infor.get('road'),
                        face_first = '' if not all_infor.get('face_first') else all_infor.get('face_first'),
                        direction_balcony = '' if not all_infor.get('Hướng ban công') else all_infor.get('Hướng ban công'),
                        description = '' if not all_infor.get('description') else all_infor.get('description'),
                        area = '' if not all_infor.get('area') else all_infor.get('area'),
                        unit_area = '' if not all_infor.get('unit_area') else all_infor.get('unit_area'),
                        images = '' if not all_infor.get('images') else all_infor.get('images'),
                        type_new = '' if not all_infor.get('Loại tin') else all_infor.get('Loại tin'),
                        direction_of_house = '' if not all_infor.get('Hướng nhà') else all_infor.get('Hướng nhà'),
                        created_at = '' if not all_infor.get('Ngày đăng') else all_infor.get('Ngày đăng'),
                        exp_at = '' if not all_infor.get('Ngày hết hạn') else all_infor.get('Ngày hết hạn'),
                        id_per_post = '' if not all_infor.get('id_per') else all_infor.get('id_per'),
                        name_per = '' if not all_infor.get('name_per') else all_infor.get('name_per'),
                        phone = '' if not all_infor.get('phone') else all_infor.get('phone'),
                        id_provinces = id_province,
                        id_news = '' if not all_infor.get('Mã tin') else all_infor.get('Mã tin'))
        else:
            continue
        #UPDATE STATUS NEWS
        update_news = query_update('news', {'status': 1},id_news = all_infor.get('Mã tin'))
        
        #UPDATE PER POST
        if all_infor.get('id_per'):
            check_exists_user_post = get_only_row('user_post', id_web =  all_infor.get('id_per'))
            if len(check_exists_user_post)>0:
                total = int(check_exists_user_post[0][3]) + 1
                update_user = query_update('user_post', {'total_post':total }, id_web = all_infor.get('id_per'))
                
            else:
                update_user = query_insert('user_post', 
                            name = '' if not all_infor.get('name_per') else all_infor.get('name_per'),
                            id_web = '' if not all_infor.get('id_per') else all_infor.get('id_per'),
                            total_post = 1)

    
    



