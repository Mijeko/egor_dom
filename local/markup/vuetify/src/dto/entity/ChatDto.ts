import type ChatMessageDto from "@/dto/entity/ChatMessageDto.ts";
import type ChatMemberDto from "@/dto/entity/ChatMemberDto.ts";

export default interface ChatDto {
  id: number;
  userId: number;
  acceptUserId: number;
  acceptMember: ChatMemberDto,
  messages: ChatMessageDto[]
}
