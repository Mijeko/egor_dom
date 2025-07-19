import type ControllerApiResponseDto from "@/dto/response/ControllerApiResponseDto.ts";

export default interface ApartmentPrefilterResponseDto extends ControllerApiResponseDto {
  data: {
    count: number;
  }
}
