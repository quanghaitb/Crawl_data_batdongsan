import requests
import random
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from db_connection import *
from selenium.webdriver.common.by import By
import time
from selenium.common.exceptions import NoSuchElementException
import re
from datetime import datetime
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support import expected_conditions as EC



def create_chrome():
    chrome_options = Options()
    chrome_options.add_argument('--headless')
    chrome_options.add_argument('--no-sandbox')
    chrome_options.add_argument('--disable-dev-shm-usage')
    driver = webdriver.Chrome('/usr/bin/chromedriver',chrome_options=chrome_options)
    


# find_element(By.ID, "id")
# find_element(By.NAME, "name")
# find_element(By.XPATH, "xpath")
# find_element(By.LINK_TEXT, "link text")
# find_element(By.PARTIAL_LINK_TEXT, "partial link text")
# find_element(By.TAG_NAME, "tag name")
# find_element(By.CLASS_NAME, "class name")
# find_element(By.CSS_SELECTOR, "css selector")


# driver.find_element(By.XPATH, '//button[text()="Some text"]')
# driver.find_elements(By.XPATH, '//button')



def get_total_new(url):
    driver = webdriver.Chrome()
    driver.get(url)
    time.sleep(5)
    get_total_bat_dong_san = driver.find_elements(By.XPATH, "//span[@id ='count-number']")
    try:
        
        total = int(get_total_bat_dong_san[0].text.replace('.',''))
    except NoSuchElementException as E:
        print(E)
        driver.close()
    driver.close()
    return total
def get_total_pages(total, limit):
    total_pages = int(total/limit) + 1
    return total

def check_exists_new(id_new):
    query = "SELECT * FROM news where id_news  = '"+ str(id_new) +"'"
    conn.execute(query)
    rows = conn.fetchall()
    if len(rows)>0:
        return 1
    else:
        return 0



def insert_all_link_new():
    

    for province in get_all_provinces():
        if province[0] == 3:
            link_province_origin = province[2]
            total_pages = get_total_pages(get_total_new(link_province_origin),20)
            for i in range(1, total_pages):
                
                links = link_province_origin.split('?')
                full_link = links[0] + '/p'+str(i) +'?'+links[1]
                driver = webdriver.Chrome()
                driver.get(full_link)
                time.sleep(3)
                get_list_news = driver.find_elements(By.XPATH, "//a[@class ='js__product-link-for-product-id']")
                check_exists = 0
                for link_new in get_list_news:
                    if check_exists > 2:
                        break
                    else:
                        get_link_origin = link_new.get_attribute('href')
                        id_new = to_decimal(get_link_origin.split('-pr')[-1])
                        
                        if check_exists_new(id_new) == 1:
                            check_exists+=1
                            continue
                        else:
                            try:
                                query_insert('news', href= get_link_origin, id_provinces= str(province[0]), status=str(0), id_news = str(id_new))
                            
                            except mysql.connector.Error as err:
                                print("Something went wrong: {}".format(err))
            

def get_all_infor(url):
    
    dict_infor = dict()
    driver = webdriver.Chrome()
    # url = "https://batdongsan.com.vn/ban-dat-duong-quoc-lo-1a-thi-tran-long-thanh-3?gidzl=4PHpOwGxAZOIYdTch28YDns8UsYqBdOy1jGlE-8jTcLTqNnXktaWP5c5VMUuBNHW3OLyCpY7dsncfpCdDG"
    # url = "https://batdongsan.com.vn/ban-can-ho-chung-cu-duong-thuan-giao-25-phuong-thuan-giao-prj-legacy-prime/-lien-ke-aeon-mall-vanh-dai-3-muc-gia-doc-ba-chi-900-trieu-pr37938546"
    try:
        
        driver.set_page_load_timeout(10)
        driver.get(url)
        

    except TimeoutException as ex:
        driver.execute_script("window.stop();")
        try:
            get_title = driver.find_element(By.XPATH, "//h1[@class ='re__pr-title pr-title js__pr-title']")
            dict_infor['title'] = get_title.text
        except NoSuchElementException:
            # isrunning = 0
            f = open("log.txt", "a")
            f.write("Exception has been thrown. " + str(url))
            f.write('\n')
            f.close()
            driver.close()
            return dict_infor
    # dict_infor['title'] = get_title.text
    # get_title = driver.find_element(By.XPATH, "//h1[@class ='re__pr-title pr-title js__pr-title']")
    try:
        get_title = driver.find_element(By.XPATH, "//h1[@class ='re__pr-title pr-title js__pr-title']")
        dict_infor['title'] = get_title.text
        get_address = driver.find_element(By.XPATH, "//span[@class ='re__pr-short-description js__pr-address']")
        dict_infor['address'] = get_address.text
        short_description =  driver.find_elements(By.XPATH, "//div[@class ='re__pr-short-info-item js__pr-short-info-item']")
        for item in short_description:
            title = item.find_element(By.CLASS_NAME, 'title')
            value = item.find_element(By.CLASS_NAME, 'value')
            try:
                ext = item.find_element(By.CLASS_NAME, 'ext')
            except NoSuchElementException:
                pass
            dict_infor[title.text] = value.text
        div_description = driver.find_element(By.XPATH, "//div[@class ='re__section re__pr-description js__section js__li-description']")
        description = div_description.find_element(By.XPATH, "//div[@class ='re__section-body re__detail-content js__section-body js__pr-description js__tracking']")
        
        dict_infor['description'] = (description.text).replace("'",'"')
        #NAME POST
        person_post = None
        name_person_post = ''
        try:
            person_post = driver.find_element(By.XPATH, "//div[@class ='re__contact-name js_contact-name']")
            
        except NoSuchElementException:
            pass
        if person_post:
            name_person_post = person_post.get_attribute('title')
        
        #ID PERSON POST
        get_contact = driver.find_element(By.XPATH, "//div[@class ='re__sidebar-box re__contact-box js__contact-box']")
        person_post_2 = get_contact.find_element(By.TAG_NAME, "a")
        id_person_post = person_post_2.get_attribute('href').split('/p/')[1].split("?")[0]
        dict_infor['name_per'] = name_person_post
        dict_infor['id_per'] = id_person_post
        

        #INFOR OTHER
        div_other_infor =  driver.find_element(By.XPATH, "//div[@class ='re__pr-specs-content js__other-info']")
        div_other_infor_items = driver.find_elements(By.XPATH, "//div[@class ='re__pr-specs-content-item']")
        for infor in div_other_infor_items:
            title = infor.find_element(By.CLASS_NAME, 're__pr-specs-content-item-title')
            value = infor.find_element(By.CLASS_NAME, 're__pr-specs-content-item-value')
            dict_infor[title.text] = value.text
            
            
        
        #IMAGE
        div_image = None
        dict_infor['images'] = None
        try:
            div_image =  driver.find_element(By.XPATH, "//div[@class ='re__pr-media-slide js__pr-media-slide']")
            
        except NoSuchElementException:
            pass
        if div_image:
            div_image_items = div_image.find_elements(By.TAG_NAME, "img")
            list_image = []
            for image in div_image_items:
                url_image = image.get_attribute('src')
                if url_image:
                    list_image.append(url_image)
        #ADD IMAGE
            dict_infor['images'] = ",".join(list_image)
        

        #DATE
        get_date_div = driver.find_element(By.XPATH, "//div[@class ='re__pr-short-info re__pr-config js__pr-config']")
        get_date = get_date_div.find_elements(By.XPATH, "//div[@class ='re__pr-short-info-item js__pr-config-item']")
        data_date = dict()
        for date in get_date:
            key = date.find_element(By.CLASS_NAME, 'title')
            
            value = date.find_element(By.CLASS_NAME, 'value') 
            change_format_date = value.text
            if key.text == 'Ngày đăng' or key.text == 'Ngày hết hạn': 
                change_format_date = datetime.strptime(value.text, '%d/%m/%Y').strftime('%Y-%m-%d')
            dict_infor[key.text] = change_format_date
            
        #PHONE NUMBER

        try:
            get_phone = driver.find_element(By.XPATH, "//a[@class ='re__btn re__btn-se-border--md js__zalo-chat']")
            phone_number = get_phone.get_attribute('href').split('/')[-1]
            dict_infor['phone'] = phone_number
        except NoSuchElementException:
            pass
    except NoSuchElementException:
        f = open("log.txt", "a")
        f.write("Not found description " + str(url))
        f.write('\n')
        f.close()
        driver.close()
        return dict_infor

    
    
    
        
    
    
    #HANDLE _UNIT
    fix_unit = dict()
    for key_handle, value_handle in dict_infor.items():
        if key_handle == 'Mức giá':
            
            value = value_handle
            fix_unit['price'] = to_decimal(value)
            
            if not fix_unit['price']:
                fix_unit['price'] = 'Thỏa thuận'
                fix_unit['unit_price'] = ''
            else:
                fix_unit['unit_price'] = to_unit(value_handle)
            
        if key_handle == 'Diện tích':
            value = to_decimal(value_handle)
            unit = to_unit(value_handle)
            
            fix_unit['unit_area'] = unit
            fix_unit['area'] = value
        if key_handle == 'Số phòng ngủ':
            value = to_decimal(value_handle)
            unit = to_unit(value_handle)
            fix_unit['bedroom'] = value
        if key_handle == 'Mặt tiền':
            value = to_decimal(value_handle)
            unit = to_unit(value_handle)
            fix_unit['face_first'] = value
        if key_handle == 'Đường vào':
            value = to_decimal(value_handle)
            unit = to_unit(value_handle)
            fix_unit['road'] = value
        if key_handle == 'Số tầng':
            value = to_decimal(value_handle)
            fix_unit['floor'] = value
        if key_handle == 'Số toilet':
            value = to_decimal(value_handle)
            unit = to_unit(value_handle)
            fix_unit['toilet'] = value
    dict_infor = Merge(dict_infor,fix_unit)
    
    
    return dict_infor
      
def Merge(dict1, dict2):
    res = {**dict1, **dict2}
    return res
        
def to_decimal(str):
    filter = re.findall('-?\d+(?:\,\d+)?', str.replace(".",""))
    if filter:
        return filter[0]
    else:
        return None
   

def to_unit(str):
    return str.split(' ')[-1]



    


    
# url = 'https://batdongsan.com.vn/ban-can-ho-chung-cu-phuong-tay-mo-prj-the-sakura-vinhomes-smart-city/cuc-re-3pn-dien-tich-82m2-chi-3-3-ty-ck-20-ban-cong-dn-nhan-nha-o-luon-mien-5-nam-dich-vu-pr37874458'
# get_all_infor(url) 






