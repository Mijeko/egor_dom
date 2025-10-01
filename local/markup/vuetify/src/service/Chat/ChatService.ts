import ControllerApi from "@/service/ControllerApi.ts";
import type SearchUserRequest from "@/dto/request/SearchUserRequest.ts";

export default class ChatService {
  searchUser(body: SearchUserRequest) {
    return ControllerApi.post('craft:stream.search.user', body);
  }
}
