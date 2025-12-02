import ControllerApi from "@/service/ControllerApi.ts";
import type MenuRequestDto from "@/dto/request/MenuRequestDto.ts";

export default class MenuService {
  static getMenu(body: MenuRequestDto) {
    return ControllerApi.post('craft:menu', body);
  }
}
