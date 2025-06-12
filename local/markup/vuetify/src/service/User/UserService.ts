import type AuthorizeDto from "@/dto/AuthorizeDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type RegisterRequestDto from "@/dto/RegisterRequestDto.ts";
import type ProfileUpdateDto from "@/dto/ProfileUpdateDto.ts";

export default class UserService {

  api: CraftApi = new CraftApi();

  constructor() {

  }

  authorize(authData: AuthorizeDto) {
    return this.api.post('user.login', this.api.objectToFormData({
      phone: authData.phone,
      password: authData.password
    }))
      .then((response: any) => response.json());
  }

  registration(body: RegisterRequestDto): Promise<Response> {
    return this.api.post('user.register', this.api.objectToFormData(body));
  }

  profileUpdate(body: ProfileUpdateDto) {
    return this.api.post('profile.update', this.api.objectToFormData(body))
      .then((response: any) => response.json());
  }
}
