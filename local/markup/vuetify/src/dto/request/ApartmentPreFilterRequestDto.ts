import type ApartmentFilterDto from "@/dto/ApartmentFilterDto.ts";

export default interface ApartmentPreFilterRequestDto extends ApartmentFilterDto {
  action: 'prefilter'
}
