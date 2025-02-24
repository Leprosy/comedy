import { DataItem } from "@/app/types";
import { NextRequest } from "next/server";
import { appData } from "../../data/crappyDb";

export async function POST(request: NextRequest) {
  try {
    const data: DataItem = await request.json();

    if (data.slides && data.id && data.name) {
      appData.push(data);
      return Response.json(data);
    } else {
      throw new Error(`Bad data format: ${JSON.stringify(data)}`);
    }
  } catch (e) {
    return Response.json({ msg: `${e}` }, { status: 500 });
  }
}
