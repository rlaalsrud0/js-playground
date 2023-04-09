import json
import requests

curl -X POST "https://kapi.kakao.com/v1/user/logout" \
	-H "Content-Type: application/x-www-form-urlencoded" \
	-H "Authorization: Bearer Dna8rtIQvbHr2cTsso0uHvW57f5N4DmpYvBj-wo9c5sAAAF7BNxLRA"

url = "https://kapi.kakao.com/v2/api/talk/memo/afda81cab2f7733040f290be14511bdf/send"

# 사용자 토큰
headers = {
    "Authorization": "Bearer qDJ-YmWA2EIPX0B6_IeidRRwknjtlS5i75bndAorDKYAAAF7BG-p9w" 
}


data = {
    "template_object" : json.dumps({ "object_type" : "text",
                                     "text" : "Hello, world!",
                                     "link" : {
                                                 "web_url" : "www.naver.com"
                                              }
    })
}

response = requests.post(url, headers=headers, data=data)
print(response.status_code)
if response.json().get('result_code') == 0:
    print('메시지를 성공적으로 보냈습니다.')
else:
    print('메시지를 성공적으로 보내지 못했습니다. 오류메시지 : ' + str(response.json()))