export default interface ApartmentFilterDto {
  price: {
    min: number | null,
    max: number | null,
  },
  bathroom: string[],
  renovation: string[],
  floorsTotal: number | null,
  roomsTotal: number | null,
  floor: number | null,
}
