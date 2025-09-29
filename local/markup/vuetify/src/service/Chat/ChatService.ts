import type ChatMessageDto from "@/dto/request/ChatMessageDto.ts";

export default class ChatService {

  ws: any = null;

  constructor() {

    this.ws = new WebSocket("ws://dom.local/ws/");
    this.ws.onopen = () => {
      console.log("Подключение успешно");
    };
    this.ws.onmessage = function (e: any) {
      console.log("Получено сообщение от сервера: " + e.data);
    };
  }

  sendMessage(body: ChatMessageDto) {
    this.ws.send(JSON.stringify(body));
  }
}
