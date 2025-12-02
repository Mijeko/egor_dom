import type MenuItemDto from "@/dto/present/MenuItemDto.ts";

export default interface MenuResponseDto {
  status: 'success',
  data: MenuItemDto[]
}
