export default interface ApartmentFilterDto {
  [key: string]: any;

  price: {
    min: number | null,
    max: number | null,
  },
  bathroom: string[],
  renovation: string[],
  floorsTotal: number | null,
  roomsTotal: number | null,
  floor: number | null,
  buildObjectId?: number | null,
  developerId: number[],
}
