import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";
import type ChatDto from "@/dto/entity/ChatDto.ts";

export default interface FindChatResponseDto extends ComponentControllerApiResponseDto {
  data: {
    chat: ChatDto | null
  }
}
