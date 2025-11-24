import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface AuthResponseDto extends ComponentControllerApiResponseDto {
  data: {
    redirect: string
  }
}
