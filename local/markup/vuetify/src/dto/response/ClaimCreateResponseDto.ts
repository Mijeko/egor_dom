import type ControllerApiResponseDto from "@/dto/response/ControllerApiResponseDto.ts";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";

export default interface ClaimCreateResponseDto extends ControllerApiResponseDto {
  data: {
    claim: ClaimDto
  }
}
