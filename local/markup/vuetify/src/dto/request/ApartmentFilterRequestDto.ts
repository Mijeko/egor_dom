import type ApartmentFilterDto from "@/dto/ApartmentFilterDto.ts";

export default interface ApartmentFilterRequestDto extends ApartmentFilterDto {
  action: 'filter'
}
