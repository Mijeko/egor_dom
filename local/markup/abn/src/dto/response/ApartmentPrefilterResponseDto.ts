import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface ApartmentPrefilterResponseDto extends ComponentControllerApiResponseDto {
  data: {
    count: number;
  }
}
