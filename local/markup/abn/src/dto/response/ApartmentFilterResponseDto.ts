import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface ApartmentFilterResponseDto extends ComponentControllerApiResponseDto {
  data: {
    filterUrl: string;
    items: ApartmentDto[];
  }
}
