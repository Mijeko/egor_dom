import type ControllerApiResponseDto from "@/dto/response/ControllerApiResponseDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default interface ApartmentFilterResponseDto extends ControllerApiResponseDto {
  data: {
    filterUrl: string;
    items: ApartmentDto[];
  }
}
