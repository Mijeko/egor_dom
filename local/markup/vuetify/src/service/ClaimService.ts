import type ClaimCreateRequestDto from "@/dto/request/ClaimCreateRequestDto.ts";
import ControllerApi from "@/service/ControllerApi.ts";

export default class ClaimService {
  createClaim(body: ClaimCreateRequestDto) {
    return ControllerApi.post('craft:claim.create', body)
  }
}
