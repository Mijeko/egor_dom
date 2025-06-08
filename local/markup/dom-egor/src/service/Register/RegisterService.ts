import CraftApi from "@/service/CraftApi.ts";
import type RegisterRequestDto from "@/Dto/RegisterRequestDto.ts";

export default class RegisterService {

  api: CraftApi = new CraftApi();

  constructor() {
  }


  execute(body: RegisterRequestDto): Promise<Response> {
    return this.api.post('user.register', this.api.objectToFormData(body));
  }

}
