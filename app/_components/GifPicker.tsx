import { useEffect, useState } from "react";
import Image from "next/image";

export const GifPicker = () => {
  const [files, setFiles] = useState<string[]>([]);
  useEffect(() => {
    const fetchList = async () => {
      const req = await fetch("/api/gifs");
      const data = await req.json();
      setFiles(data.files);
    };

    fetchList();
  }, []);

  return (
    <div>
      <h1>Pick one</h1>

      <div className="grid grid-cols-4 gap-2">
        {files.map((item: string, i: number) => (
          <div key={i}>
            <Image alt={item} src={`/img/${item}`} width={150} height={150} unoptimized={true} />
          </div>
        ))}
      </div>
    </div>
  );
};
