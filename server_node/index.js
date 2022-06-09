var express = require("express");
const http = require("http");
var app = express();
const server = http.createServer(app);

const socketIo = require("socket.io")(server, {
  cors: {
    origin: "*",
  },
});

socketIo.on("connection", (socket) => {
  ///Handle khi có connect từ client tới

  socket.on("chatMessage", (data) => {
    socketIo.emit(`_chatMessage.${data.idgroupchat}.${data._id}`, data);
  });

  socket.on("requestJoin", (data) => {
    socketIo.emit(`_requestJoin.${data.id}`, data);
  });

  socket.on("acceptJoin", (data) => {
    socketIo.emit(`_acceptJoin.${data.id}`, data)
  })

  socket.on("disconnect", () => {
    console.log("Client disconnected");
  });
});

server.listen(process.env.PORT || 4444, () => {
  console.log("Server running port 4444");
});
