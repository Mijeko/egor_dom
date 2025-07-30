import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface RegisterAgentResponseDto extends ComponentControllerApiResponseDto {
  data: {
    redirect: string;
  }
}
