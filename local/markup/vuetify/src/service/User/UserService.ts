import type AuthorizeDto from "@/dto/AuthorizeDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type ProfileUpdateDto from "@/dto/ProfileUpdateDto.ts";
import type RegisterAgentRequestDto from "@/dto/request/RegisterAgentRequestDto.ts";
import type RegisterAgentResponseDto from "@/dto/response/RegisterAgentResponseDto.ts";
import type RegisterStudentRequestDto from "@/dto/request/RegisterStudentRequestDto.ts";
import type RegisterStudentResponseDto from "@/dto/response/RegisterStudentResponseDto.ts";

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

  registrationAgent(body: RegisterAgentRequestDto): Promise<RegisterAgentResponseDto> {
    return this.api.post('user.register.agent', this.api.objectToFormData(body))
      .then((response: any) => response.json());
  }

  registrationStudent(body: RegisterStudentRequestDto): Promise<RegisterStudentResponseDto> {
    return this.api.post('user.register.student', this.api.objectToFormData(body));
  }

  profileUpdate(body: ProfileUpdateDto) {
    return this.api.post('profile.update', this.api.objectToFormData(body))
      .then((response: any) => response.json());
  }
}
