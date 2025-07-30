import type ClaimDto from "@/dto/entity/ClaimDto.ts";
import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface ClaimCreateResponseDto extends ComponentControllerApiResponseDto {
  data: {
    claim: ClaimDto
  }
}
