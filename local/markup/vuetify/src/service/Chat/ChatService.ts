import ControllerApi from "@/service/ControllerApi.ts";
import type SearchUserRequest from "@/dto/request/SearchUserRequest.ts";
import type FindDialogRequestDto from "@/dto/request/FindDialogRequestDto.ts";

export default class ChatService {
  searchUser(body: SearchUserRequest) {
    return ControllerApi.post('craft:stream.search.user', body);
  }

  findDialog(body: FindDialogRequestDto) {
    return ControllerApi.post('craft:stream.search.chat', body);
  }
}
