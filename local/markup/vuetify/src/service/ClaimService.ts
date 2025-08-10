import ControllerApi from "@/service/ControllerApi.ts";
import type ClaimCreateShortRequestDto from "@/dto/request/ClaimCreateShortRequestDto.ts";

export default class ClaimService {
  createClaim(body: ClaimCreateShortRequestDto) {
    return ControllerApi.post('craft:claim.create', body)
  }
}
