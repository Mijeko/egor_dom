export default interface MenuItemDto {
  title: string;
  url: string;
  params?: Record<string, any>;
  chain?: MenuItemDto[];
}
