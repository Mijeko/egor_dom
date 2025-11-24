export default interface ProfileEditUserDataDto {
  profileType: 'phys' | 'jur' | 'ip';
  id: number;
  name: string;
  family: string;
  last_name: string;
  uf_corr_acc?: string;
  uf_inn?: string;
  uf_ogrn?: string;
  uf_curr_acc: string;
  uf_kpp: string;
  uf_bik: string;
  uf_post_address: string;
  uf_legal_address: string;
  uf_bank_name: string;
}
