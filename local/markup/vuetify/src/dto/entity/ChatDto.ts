import type ChatMessageDto from "@/dto/entity/ChatMessageDto.ts";
import type ChatMemberDto from "@/dto/entity/ChatMemberDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default interface ChatDto {
  id: number;
  userId: number;
  acceptUserId: number;
  acceptMember: ChatMemberDto,
  messages: ChatMessageDto[],
  members: BxUserDto[]
}
