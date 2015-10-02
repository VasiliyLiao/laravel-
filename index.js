var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
var allClients = [];


redis.subscribe('chat-channel', function (err, count) {
});

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit('channel:all' , message.data);
});

io.sockets.on('connection', function(socket) {

	var message = {
   			data : {
   				username : 'admin',
   				message : ''
   			}
   		};
   socket.on('add user', function(username){
      allClients[socket.id] = username;		
      console.log(socket.id + ' connect!');
   		message.data.message = username + ' join us';
    	io.emit('chat-channel:all' , message.data);
   });
   socket.on('disconnect', function() {
      console.log(socket.id + ' disconnect!');
      message.data.message = allClients[socket.id] + ' give up us';
      io.emit('chat-channel:all' , message.data);

      delete allClients[socket.id];
   });

});


http.listen(3000, function () {
    console.log('Listening on Port 3000');
});
