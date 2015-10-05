# Larave利用Broadcast實作聊天室功能

利用 Laravel Events 控制 redis 與　nodejs　做溝通，實作聊天室功能。

------

### 須具備以下環境
>* PHP 5.5.9以上
>* NodeJS
>* Redis

------

## 設定
### 1.安裝composer package
``` composer install ```
### 2.安裝npm package
``` npm install express ioredis socket.io --save ```
### 3.env檔進行修改
``` BROADCAST_DRIVER=redis```

參考連接為:[http://jaceju.net/2015/07/26/laravel-events-broadcasting/]
