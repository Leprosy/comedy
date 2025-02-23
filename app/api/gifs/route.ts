import { readdir } from "node:fs/promises";

export async function GET() {
  const data = [];

  try {
    const files = await readdir("./public/img");

    for (const file of files) {
      data.push(file);
    }

    return Response.json({ files: data });
  } catch (e) {
    return Response.json({ error: `${e}` });
  }
}
