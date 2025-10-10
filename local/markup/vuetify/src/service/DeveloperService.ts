import ControllerApi from "@/service/ControllerApi.ts";
import type ManagerFeedUpdateRequestDto from "@/dto/request/ManagerFeedUpdateRequestDto.ts";

export default class DeveloperService {
  static updateFeedInfo(body: ManagerFeedUpdateRequestDto) {
    return ControllerApi.post('craft:manager.feed.update', body);
  }
}
