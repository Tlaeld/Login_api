
## OpenID查询接口
此接口提供查询OpenID，返回是否存在OpenID
#### 接口URL
> https://127.0.0.1/login.php?mode=0

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 0 | 必填 | api功能选择 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| openid     | oLT0a49GFzSOZ7J7jV2Pq8B9G7a0 |  必填 | 用户的openid |
| wechat_name     | Extrader |  必填 | 用户微信号 |

#### 成功响应示例
```javascript
存在OpenID：
1

不存在OpenID：
0
```



## 插入OpenID接口
此接口提供OpenID的插入功能，需要传入用户名、密码和OpenID，通过判读，若用户名密码正确，则记录该用户的OpenID
#### 接口URL
> https://127.0.0.1/login.php?mode=1

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 1 | 必填 | api功能选择 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| username     | 1 |  必填 | 用户名 |
| password     | 1 |  必填 | 密码 |
| openid     | oLT0a49GFzSOZ7J7jV2Pq8B9G7a0 |  必填 | OpenID |
| wechat_name     | Extrader |  选填 | 用户微信号 |

#### 成功响应示例
```javascript
插入成功：
1

账号或密码错误：
0
```



## PC登录接口
PC登录接口，此接口提供PC端登录的功能，并根据权限提供不同的相应
#### 接口URL
> https://127.0.0.1/login.php?mode=2

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 2 | 必填 | api功能选择 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| username     | 1 |  必填 | 用户名 |
| password     | 1 |  必填 | 密码 |

#### 成功响应示例
```javascript
非管理员相应：
{
	"state": "1"
}

管理员相应：
{
	"state": "1",
	"token": "2accdef9309d7f9b15941c968c17d7cf"
}

账号或密码错误：
{
	"state": "0"
}
```

| 参数        | 示例值   |  参数描述  |
| :--------   | :-----  | :----  |
| state     | 1 | 1为正确，0为账号或密码错误 |
| token     | 2accdef9309d7f9b15941c968c17d7cf | 用户token，只有管理员会返回 |

#### 错误响应示例
```javascript
{
	"state": "0"
}
```


## 管理员查询接口
此接口提供管理员查询权限。
#### 接口URL
> https://127.0.0.1/login.php?mode=3&operating=1

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 3 | 必填 | api功能选择 |
| operating     | 1 | 必填 | 管理员操作模式：1为查询所用用户信息，2为增加一个用户，3为删除一个用户，4为修改用户信息 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| token     | 5d8e52516d00dfc1b0c49659a1008bf1 |  必填 | token |

#### 成功响应示例
```javascript
{
	"users": [
		{
			"username": "1",
			"wechat_name": null,
			"Authority": "Y"
		},
		{
			"username": "2",
			"wechat_name": null,
			"Authority": "N"
		},
		{
			"username": "3",
			"wechat_name": "1",
			"Authority": "Y"
		}
	]
}
```

| 参数        | 示例值   |  参数描述  |
| :--------   | :-----  | :----  |
| username     | 1 | 用户名 |
| wechat_name     | 1 | 用户微信号 |
| Authority     | Y | 是否为管理员 |

#### 错误响应示例
```javascript
{"0"}
```


## 管理员增加用户接口
此接口提供管理员增加用户权限。
#### 接口URL
> https://127.0.0.1/login.php?mode=3&operating=2

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 3 | 必填 | api功能选择 |
| operating     | 2 | 必填 | 管理员操作模式：1为查询所用用户信息，2为增加一个用户，3为删除一个用户，4为修改用户信息 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| username     | admin |  必填 | 用户名 |
| password     | admin |  必填 | 密码 |
| Authority     | Y |  必填 | 是否为管理员   Y / N |
| token     | 5d8e52516d00dfc1b0c49659a1008bf1 |  必填 | token |

#### 成功响应示例
```javascript
{
	"state": "1"
}
```

| 参数        | 示例值   |  参数描述  |
| :--------   | :-----  | :----  |
| state     | 1 | 正确返回1，错误返回-1 |

#### 错误响应示例
```javascript
{
	"state": "-1"
}
```


## 管理员删除用户接口
此接口提供管理员删除用户的权限。
*注：无法判断数据库中是否存在某个用户*
#### 接口URL
> https://127.0.0.1/login.php?mode=3&operating=3

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 3 | 必填 | api功能选择 |
| operating     | 3 | 必填 | 管理员操作模式：1为查询所用用户信息，2为增加一个用户，3为删除一个用户，4为修改用户信息 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| username     | admin |  必填 | 用户名 |
| token     | 5d8e52516d00dfc1b0c49659a1008bf1 |  必填 | token |

#### 成功响应示例
```javascript
{
	"state": "1"
}
```

| 参数        | 示例值   |  参数描述  |
| :--------   | :-----  | :----  |
| state     | 1 | 正确返回1，错误返回-1 |

#### 错误响应示例
```javascript
{
	"state": "-1"
}
```


## 管理员修改用户信息接口
此接口提供管理员修改用户信息权限。
#### 接口URL
> https://127.0.0.1/login.php?mode=3&operating=4

#### 请求方式
> POST

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| mode     | 3 | 必填 | api功能选择 |
| operating     | 4 | 必填 | 管理员操作模式：1为查询所用用户信息，2为增加一个用户，3为删除一个用户，4为修改用户信息 |





#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| username     | admin |  必填 | 用户名 |
| password     | admin |  选填 | 密码 |
| Authority     | Y |  选填 | 是否为管理员   Y / N |
| token     | 5d8e52516d00dfc1b0c49659a1008bf1 |  必填 | token |

#### 成功响应示例
```javascript
{
	"state": "1"
}
```

| 参数        | 示例值   |  参数描述  |
| :--------   | :-----  | :----  |
| state     | 1 | 正确返回1，错误返回-1 |

#### 错误响应示例
```javascript
{
	"state": "-1"
}
```

