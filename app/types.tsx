/* comedy types */
export type DataItem = {
  id: number;
  name: string;
  slides: SlideData[];
};

export type SlideData = {
  img: string;
  time: number;
  caption: string;
};
