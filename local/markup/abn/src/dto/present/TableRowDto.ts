export interface TableRowDto {
  [key: string]: any;
  columns: TableColDto[]
}


export interface TableColDto {
  [key: string]: any;
  title: string;
  key: string;
  align?: string;
}
