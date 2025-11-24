import type ChatMessageDto from "@/dto/request/ChatMessageDto.ts";
import type ChatServiceParams from "@/dto/ChatServiceParams.ts";

export default class WsChatService {

  ws: any = null;

  constructor(params: ChatServiceParams) {

    this.ws = new WebSocket(params.host ?? "ws://dom.local/ws/");
    this.ws.onopen = () => {
      console.log("Подключение успешно");
    };


    if (typeof params.callback === 'function') {
      this.ws.onmessage = params.callback;
    } else {
      this.ws.onmessage = function (e: any) {

        let data = null;

        try {
          data = JSON.parse(e.data);
        } catch (err) {
          data = e.data;
        }

        console.log("Получено сообщение от сервера: ", data);
      };
    }
  }

  sendMessage(body: ChatMessageDto) {
    this.ws.send(JSON.stringify(body));
  }
}
