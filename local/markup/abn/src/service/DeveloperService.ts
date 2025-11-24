import ControllerApi from "@/service/ControllerApi.ts";
import type DeveloperUpdateRequestDto from "@/dto/request/ManagerFeedUpdateRequestDto.ts";

export default class DeveloperService {
  static update(body: DeveloperUpdateRequestDto) {
    return ControllerApi.post('craft:developer.update', body);
  }
}
