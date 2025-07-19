import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type ProfileUpdateDto from "@/dto/ProfileUpdateDto.ts";
import type RegisterAgentRequestDto from "@/dto/request/RegisterAgentRequestDto.ts";
import type RegisterAgentResponseDto from "@/dto/response/RegisterAgentResponseDto.ts";
import type RegisterStudentRequestDto from "@/dto/request/RegisterStudentRequestDto.ts";
import type RegisterStudentResponseDto from "@/dto/response/RegisterStudentResponseDto.ts";
import ObjectMap from "@/core/ObjectMap.ts";
import ControllerApi from "@/service/ControllerApi.ts";

export default class UserService {

  api: CraftApi = new CraftApi();

  constructor() {

  }

  authorize(body: AuthorizeDto) {
    return ControllerApi.post('craft:auth', body);
  }

  registrationAgent(body: RegisterAgentRequestDto): Promise<RegisterAgentResponseDto> {
    return ControllerApi.post('craft:register.agent', body);
  }

  registrationStudent(body: RegisterStudentRequestDto): Promise<RegisterStudentResponseDto> {
    return ControllerApi.post('craft:register.student', body);
  }

  profileUpdate(body: ProfileUpdateDto) {
    return ControllerApi.post('craft:profile.update', body);
  }
}
