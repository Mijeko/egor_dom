import type BxImage from "@/dto/bitrix/BxImage.ts";

export default interface ChatMemberDto {
  id: number;
  chatId: number;
  userId: number;
  name: string;
  avatar: BxImage;
}
