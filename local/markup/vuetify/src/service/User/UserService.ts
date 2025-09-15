import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type ProfileUpdateDto from "@/dto/ProfileUpdateDto.ts";
import type RegisterAgentResponseDto from "@/dto/response/RegisterAgentResponseDto.ts";
import type RegisterStudentRequestDto from "@/dto/request/RegisterStudentRequestDto.ts";
import type RegisterStudentResponseDto from "@/dto/response/RegisterStudentResponseDto.ts";
import ControllerApi from "@/service/ControllerApi.ts";
import type RegisterSimpleAgentRequestDto from "@/dto/request/RegisterSimpleAgentRequestDto.ts";
import type RegisterByReferralRequestDto from "@/dto/request/RegisterByReferralRequestDto.ts";
import type CreateManagerRequestDto from "@/dto/request/CreateManagerRequestDto.ts";
import type CreateAgentRequestDto from "@/dto/request/CreateAgentRequestDto.ts";
import type CreateStudentRequestDto from "@/dto/request/CreateStudentRequestDto.ts";

export default class UserService {

  api: CraftApi = new CraftApi();

  constructor() {

  }

  authorize(body: AuthorizeDto) {
    return ControllerApi.post('craft:auth', body);
  }

  registrationAgent(body: RegisterSimpleAgentRequestDto): Promise<RegisterAgentResponseDto> {
    return ControllerApi.post('craft:register.agent', body);
  }

  registrationStudent(body: RegisterStudentRequestDto): Promise<RegisterStudentResponseDto> {
    return ControllerApi.post('craft:register.student', body);
  }

  profileUpdate(body: ProfileUpdateDto) {
    return ControllerApi.post('craft:profile.update', body);
  }

  registerByReferral(body: RegisterByReferralRequestDto) {
    return ControllerApi.post('craft:referral.join', body);
  }

  createManager(body: CreateManagerRequestDto) {
    return ControllerApi.post('craft:manager.create', body);
  }

  createAgent(body: CreateAgentRequestDto) {
    return ControllerApi.post('craft:agent.create', body);
  }

  createStudent(body: CreateStudentRequestDto) {
    return ControllerApi.post('craft:student.create', body);
  }
}
