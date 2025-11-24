export default interface AlertItemDto {
  title: string;
  text: string;
  type: "error" | "success" | "warning" | "info" | undefined;
}
