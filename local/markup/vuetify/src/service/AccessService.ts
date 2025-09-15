import {useUserStore} from "@/store.ts";
import type BxUserGroupDto from "@/dto/bitrix/BxUserGroupDto.ts";
import {toRaw} from "vue";

export default class AccessService {
  static hasRole(role: string | string[]): boolean {

    let roles: string[] = [];

    if (typeof role === "string") {
      roles.push(role);
    } else {
      roles = role;
    }

    let userStore = useUserStore();
    let user = userStore.getUser;
    if (user) {


      let positions: string[] = (Object.values(toRaw(user?.position) ?? [])).map((group: BxUserGroupDto) => {
        return group.code;
      });

      for (let role of roles) {
        if (positions.includes(role)) {
          return true;
        }
      }
    }

    return false;
  }
}
