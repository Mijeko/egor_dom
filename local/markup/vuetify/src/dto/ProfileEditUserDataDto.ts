export default interface ProfileEditUserDataDto {
  name: string;
  family: string;
  last_name: string;
  uf_corr_acc?: string;
  uf_inn?: string;
  uf_ogrn?: string;
  profileType: 'student' | 'realtor';
}
