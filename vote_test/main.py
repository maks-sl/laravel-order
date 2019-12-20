import requests
from random import randrange
from datetime import datetime
from concurrent.futures import ThreadPoolExecutor as PoolExecutor

URL = 'http://127.0.0.1:8080/vote/store'
CNT = 10


def create_attempt(dept, win):
    login_data = dict(department=dept, winner=win, finger_hash='false')
    return requests.post(URL, data=login_data, headers=dict(Referer=URL))


def get_it(blank):
    r = create_attempt(randrange(1, 15), randrange(1, 15))
    if r.status_code != 201:
        print('[Warning] Not 201 status')
    # print('[' + str(r.status_code) + ']' + str(r.content))


if __name__ == "__main__":

    start_time = datetime.now()
    print('Working... Num attempts: ' + str(CNT))

    with PoolExecutor(max_workers=16) as executor:
        for _ in executor.map(get_it, range(CNT)):
            pass

    print('Done in : ' + str(datetime.now() - start_time))
