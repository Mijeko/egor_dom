import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface RegisterByReferralResponseDto extends ComponentControllerApiResponseDto {
  data: {
    redirect: string;
  }
}
