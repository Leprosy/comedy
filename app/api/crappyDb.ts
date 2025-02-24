import { DataItem } from "../types";

export const appData: DataItem[] = [
  {
    id: 1,
    name: "Kramer ",
    slides: [
      {
        img: "kramer1.gif",
        time: 4000,
        caption: "Hello Im Kramer",
      },
      {
        img: "george1.gif",
        time: 5000,
        caption: "Im George, nice to meet you",
      },
      {
        img: "bean1.gif",
        time: 7000,
        caption: "Hello there....",
      },
      {
        img: "kramer1.gif",
        time: 4000,
        caption: "hahahahaha",
      },
    ],
  },
  {
    id: 2,
    name: "George",
    slides: [
      {
        img: "george1.gif",
        time: 4000,
        caption: "I'm George...",
      },
      {
        img: "george1.gif",
        time: 5000,
        caption: "Hi...",
      },
      {
        img: "george1.gif",
        time: 7000,
        caption: "Ok",
      },
    ],
  },
];
