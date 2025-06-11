import type AuthorizeDto from "../../dto/AuthorizeDto.ts";
import CraftApi from "../CraftApi.ts";

export class AuthService {
  execute(authData: AuthorizeDto) {
    let service = new CraftApi();
    return service.post('user.login', service.objectToFormData({
      phone: authData.phone,
      password: authData.password
    }))
      .then((response: any) => response.json());
  }
}
