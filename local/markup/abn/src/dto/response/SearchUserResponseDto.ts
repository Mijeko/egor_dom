import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default interface SearchUserResponseDto extends ComponentControllerApiResponseDto {
  data: {
    users: BxUserDto[];
  }
}
